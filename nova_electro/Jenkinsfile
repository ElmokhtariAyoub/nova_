pipeline {
    agent any

    environment {
        DOCKERHUB_CREDENTIALS = credentials('dockerhub-token') 
        DOCKER_IMAGE = 'elmokhtariayoubnova_1' 
    }

    stages {
        stage('Clone Repository') {
            steps {
                git branch: 'main', url: 'https://github.com/ElmokhtariAyoub/nova_'
            }
        }

        stage('Build Application') {
            steps {
                echo 'Building the application...'
                sh './gradlew build' // Adjust build command based on your project setup
            }
        }

        stage('Build Docker Image') {
            steps {
                echo 'Building Docker image...'
                sh 'docker build -t $DOCKER_IMAGE .'
            }
        }

        stage('Tag and Push Docker Image') {
            steps {
                echo 'Tagging and pushing Docker image to DockerHub...'
                sh 'echo $DOCKERHUB_CREDENTIALS | docker login -u elmokhtariayoub --password-stdin'
                sh 'docker tag $DOCKER_IMAGE $DOCKER_IMAGE:latest'
                sh 'docker push $DOCKER_IMAGE:latest'
            }
        }

        stage('Deploy to Remote Server') {
            steps {
                echo 'Deploying to the remote server...'
                // Add deployment logic here, e.g., SSH into the server and run Docker commands
                sh '''
                ssh user@remote-server '
                    docker pull $DOCKER_IMAGE:latest &&
                    docker-compose up -d
                '
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
