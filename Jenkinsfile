pipeline {
    agent any

    environment {
        DOCKERHUB_CREDENTIALS = credentials('dockerhub-token') // Assurez-vous que l'ID correspond aux nouveaux identifiants dans Jenkins.
        DOCKER_IMAGE = 'bahaeddinesaim/novaelectro'
    }

    stages {
        stage('Clone Repository') {
            steps {
                echo 'Cloning the repository...'
                git branch: 'master', url: 'https://github.com/ElmokhtariAyoub/nova_'
            }
        }

        stage('Build Docker Image') {
            steps {
                echo 'Building Docker image...'
                bat '''
                docker build -t %DOCKER_IMAGE% . --progress=plain
                '''
            }
        }

        stage('Debug Docker Login') {
            steps {
                echo 'Testing Docker Login...'
                bat '''
                echo Username: %DOCKERHUB_CREDENTIALS_USR%
                echo Password: ****
                '''
            }
        }

        stage('Tag and Push Docker Image') {
            steps {
                echo 'Tagging and pushing Docker image to DockerHub...'
                bat '''
                echo %DOCKERHUB_CREDENTIALS_PSW% | docker login -u %DOCKERHUB_CREDENTIALS_USR% --password-stdin
                IF %ERRORLEVEL% NEQ 0 EXIT /B %ERRORLEVEL%
                docker tag %DOCKER_IMAGE% %DOCKER_IMAGE%:latest
                docker push %DOCKER_IMAGE%:latest
                '''
            }
        }

        stage('Deploy to Remote Server') {
            steps {
                echo 'Deploying to the remote server...'
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
