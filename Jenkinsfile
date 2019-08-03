pipeline {
  agent {
    label 'master'
  }

  stages {
    stage('Behat') {
        agent {
            image 'jenkins/chromium-php'
        }
        steps {
          sh 'composer install'
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