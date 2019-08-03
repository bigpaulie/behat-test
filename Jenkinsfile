pipeline {
  agent {
    label 'master'
  }

  stages {
    stage('Behat') {
        agent {
            docker {
                image 'jenkins/chromium-php'
            }
        }
        steps {
          sh 'composer install'
          sh 'mkdir -p build/reports/behat'
          sh './vendor/bin/behat -f pretty -o std -f junit -o build/reports/behat'
        }
        post {
          always {
            junit 'build/reports/**/*.xml'
            archiveArtifacts artifacts: 'screenshots/*.png', fingerprint: true
          }
        }
    }
  }
}