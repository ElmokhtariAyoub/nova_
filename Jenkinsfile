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
                docker build -t %DOCKER_IMAGE% .
                if %ERRORLEVEL% neq 0 (
                    echo ERROR: Docker build failed!
                    exit /b 1
                )
                '''
            }
        }

        stage('Tag and Push Docker Image') {
            steps {
                echo 'Logging in to Docker Hub and pushing Docker image...'
                bat '''
                echo %DOCKER_PASSWORD% | docker login -u %DOCKER_USERNAME% --password-stdin
                if %ERRORLEVEL% neq 0 (
                    echo ERROR: Docker login failed!
                    exit /b 1
                )

                echo Tagging Docker image...
                docker tag %DOCKER_IMAGE% %DOCKER_IMAGE%:latest
                if %ERRORLEVEL% neq 0 (
                    echo ERROR: Docker tag failed!
                    exit /b 1
                )

                echo Pushing Docker image...
                docker push %DOCKER_IMAGE%:latest
                if %ERRORLEVEL% neq 0 (
                    echo ERROR: Docker push failed!
                    exit /b 1
                )

                echo Docker image pushed successfully!
                '''
            }
        }

        stage('Deploy to Remote Server') {
            steps {
                echo 'Deploying to remote server...'
                bat '''
                set DOCKER_IMAGE=%DOCKER_IMAGE%
                ssh user@localhost "docker pull %DOCKER_IMAGE%:latest && docker-compose up -d"
                if %ERRORLEVEL% neq 0 (
                    echo ERROR: Deployment failed!
                    exit /b 1
                )
                echo Deployment successful!
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
