pipeline {
    agent any

    environment {
        DOCKER_USERNAME = 'bahaeddinesaim'
        DOCKER_PASSWORD = 'dckr_pat_Ky0bNylmkA94N1u64C5-N49-oRs'
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

        stage('Tag and Push Docker Image') {
            steps {
                echo 'Tagging and pushing Docker image to DockerHub...'
                bat '''
                echo %DOCKER_PASSWORD% | docker login -u %DOCKER_USERNAME% --password-stdin
                IF %ERRORLEVEL% NEQ 0 (
                    echo ERROR: Docker login failed!
                    EXIT /B 1
                )
                
                docker tag %DOCKER_IMAGE% %DOCKER_IMAGE%:latest
                IF %ERRORLEVEL% NEQ 0 (
                    echo ERROR: Docker tag failed!
                    EXIT /B 1
                )
                
                docker push %DOCKER_IMAGE%:latest
                IF %ERRORLEVEL% NEQ 0 (
                    echo ERROR: Docker push failed!
                    EXIT /B 1
                )
                
                echo Docker image pushed successfully!
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
