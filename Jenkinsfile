pipeline {
    agent any

    stages {
        stage('GIT Stage') {
            steps {
               git branch: 'main', credentialsId: 'jenkins-token', url: 'https://github.com/bitman26/BIG-IP.git'   
            }
        }
        stage('Running Backup BIG-IP') {
            steps {
                ansiblePlaybook installation: 'ansible', inventory: 'inventory', playbook: 'playbook.yml', extras: '--extra-vars "username=${usuario} password=${password} chg=${change}"'
            }
        }
        stage('Terraform init') {
            steps {
                sh 'terraform init'
            }
        }
        stage('Terraform Deploy') {
            steps {
                 sh 'terraform ${action} -var="user-admin=${usuario}" -var="password=${password}" --auto-approve'
            }
        }
    }
}
