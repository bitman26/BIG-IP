variable password {}
variable user-admin {}

terraform {
  required_providers {
    bigip = {
      source = "terraform-providers/bigip"
    }
  }
  required_version = ">= 0.13"
}

provider "bigip" {
  address  = var.bigip-01
  username = var.user-admin
  password = var.password
}

resource "bigip_ltm_node" "node-01" {
  name             = "/Common/terraform_node1"
  address          = var.srv-01
  connection_limit = "0"
  dynamic_ratio    = "1"
  rate_limit       = "disabled"
  fqdn {
    address_family = "ipv4"
    interval       = "3000"
  }
}

resource "bigip_ltm_node" "node-02" {
  name             = "/Common/terraform_node2"
  address          = var.srv-02
  connection_limit = "0"
  dynamic_ratio    = "1"
  rate_limit       = "disabled"
  fqdn {
    address_family = "ipv4"
    interval       = "3000"
  }
}

resource "bigip_ltm_monitor" "monitor" {
  name   = "/Common/terraform_monitor"
  parent = "/Common/http"
}

resource "bigip_ltm_pool" "pool" {
  name                   = "/Common/terrafom-pool-01"
  load_balancing_mode    = "round-robin"
  minimum_active_members = 1
  monitors               = [bigip_ltm_monitor.monitor.name]
}

resource "bigip_ltm_pool_attachment" "att-pool" {
  for_each = toset([bigip_ltm_node.node-01.name, bigip_ltm_node.node-02.name])
  pool     = bigip_ltm_pool.pool.name
  node     = "${each.key}:80"
}

resource "bigip_ltm_virtual_server" "tf-vs01" {
  name                       = "/Common/terraform_vs_https"
  destination                = var.ip-vs-01
  port                       = 443
  client_profiles            = ["/Common/clientssl"]
  server_profiles            = ["/Common/serverssl"]
  source_address_translation = "automap"
  pool                       = bigip_ltm_pool.pool.name 
}
