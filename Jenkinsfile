pipeline {
    agent any

    environment {
        DOCKERHUB_CREDENTIALS = credentials('dockerhub-token')
        DOCKER_IMAGE = 'elmokhtariayoub/nova_1' // Updated with Docker Hub naming convention
    }

    stages {
        stage('Clone Repository') {
            steps {
                echo 'Cloning the repository...'
                git branch: 'master', url: 'https://github.com/ElmokhtariAyoub/nova_'
            }
        }

        stage('Build Application') {
            steps {
                echo 'Building the application...'
                // Use ./gradlew only if the Gradle wrapper is present in the repository
                bat './gradlew build'
            }
        }

        stage('Build Docker Image') {
            steps {
                echo 'Building Docker image...'
                bat "docker build -t ${DOCKER_IMAGE} ."
            }
        }

        stage('Tag and Push Docker Image') {
            steps {
                echo 'Tagging and pushing Docker image to DockerHub...'
                sh '''
                echo ${DOCKERHUB_CREDENTIALS_PSW} | docker login -u ${DOCKERHUB_CREDENTIALS_USR} --password-stdin
                docker tag ${DOCKER_IMAGE} ${DOCKER_IMAGE}:latest
                docker push ${DOCKER_IMAGE}:latest
                '''
            }
        }

        stage('Deploy to Remote Server') {
            steps {
                echo 'Deploying to the remote server...'
                // Ensure SSH keys are configured properly for non-interactive SSH
                sh '''
                ssh user@remote-server "
                    docker pull ${DOCKER_IMAGE}:latest &&
                    docker-compose up -d
                "
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
