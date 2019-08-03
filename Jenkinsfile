pipeline {
  agent none
  stages {
    stage('Composer Install') {
      agent {
        dockerfile {
            filename 'Dockerfile'
            dir '.docker/phpunit'
        }
      }
      steps {
        sh 'composer install'
      }
    }
    stage('PHPUnit') {
      agent {
          dockerfile {
              filename 'Dockerfile'
              dir '.docker/phpunit'
              args '-p 9222:9222'
          }
        }
      steps {
        sh './vendor/bin/phpunit --log-junit build/reports/junit.xml --coverage-html build/coverage'
      }
      post {
        always {
          junit 'build/reports/**/*.xml'
        }
      }
    }
    stage('Behat') {
        agent {
            dockerfile {
                filename 'Dockerfile'
                dir '.docker/behat/'
            }
          }
        steps {
          sh './vendor/bin/behat -f pretty -o std -f junit -o build/reports/behat'
        }
        post {
          always {
            junit 'build/reports/**/*.xml'
            archiveArtifacts artifacts: 'screenshots/*.png', fingerprint: true
          }
        }
    }
    stage('Publish Coverage') {
      agent {
        label 'master'
      }
      steps {
            publishHTML([
              allowMissing: false,
              alwaysLinkToLastBuild: false,
              keepAll: true,
              reportDir: 'build/coverage',
              reportFiles: '*',
              reportName: "Coverage Report"
            ])
        }
      }
    }

  }