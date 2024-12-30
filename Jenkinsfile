pipeline {
    agent any

    environment {
        DOCKER_USERNAME = 'bahaeddinesaim'
        DOCKER_PASSWORD = 'dckr_pat_Ky0bNylmkA94N1u64C5-N49-oRs'
        DOCKER_IMAGE = 'bahaeddinesaim/novaelectro'
    }

    stages {
        
        stage('Deploy to Remote Server') {
            steps {
                echo 'Deploying to remote server...'
                bat '''
                ssh user@remote-server "docker pull %DOCKER_IMAGE%:latest && docker-compose up -d"
                '''
            }
        }
    }

    post {
        always {
            echo 'Pipeline finished.'
        }
        success {
            echo 'Pipeline completed successfully!'
        }
        failure {
            echo 'Pipeline failed. Check logs for details.'
        }
    }
}
