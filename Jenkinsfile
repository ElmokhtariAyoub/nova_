pipeline {
    agent any

    environment {
        DOCKER_USERNAME = 'bahaeddinesaim'  // Votre nom d'utilisateur Docker Hub
        DOCKER_PASSWORD = 'dckr_pat_Ky0bNylmkA94N1u64C5-N49-oRs' // Votre token Docker Hub
        DOCKER_IMAGE = 'bahaeddinesaim/novaelectro' // Nom de l'image Docker
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
                echo 'Debugging Docker Login...'
                bat '''
                echo Username: %DOCKER_USERNAME%
                echo Password: ****
                '''
            }
        }

        stage('Tag and Push Docker Image') {
            steps {
                echo 'Tagging and pushing Docker image to DockerHub...'
                bat '''
                echo %DOCKER_PASSWORD% | docker login -u %DOCKER_USERNAME% --password-stdin
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
