pipeline {
  agent {
    docker {
      image 'localhost:5000/jenkins/phpunit:latest'
      args '-e behat_host=`hostname -i`:9222'
    }

  }
  stages {
    stage('Composer Install') {
      steps {
        sh 'composer install'
      }
    }
    stage('PHPUnit') {
      steps {
        sh './vendor/bin/phpunit --log-junit build/reports/junit.xml --coverage-html build/coverage'
      }
    }
    stage('Behat') {
        steps {
          sh './vendor/bin/behat'
        }
    }
    stage('Publish Coverage') {
      steps {
            publishHTML([
              allowMissing: false,
              alwaysLinkToLastBuild: false,
              keepAll: true,
              reportDir: 'build/coverage',
              reportFiles: 'index.html',
              reportName: "Coverage Report"
            ])
        }
      }
    }
    post {
      always {
        junit 'build/reports/**/*.xml'

      }

    }
  }