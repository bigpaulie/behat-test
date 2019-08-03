pipeline {
  agent none

  }
  stages {
    stage('Composer Install') {
      docker {
        dockerfile {
            filename './docker/phpunit/Dockerfile'
        }
      }
      steps {
        sh 'composer install'
      }
    }
    stage('PHPUnit') {
      docker {
          dockerfile {
              filename './docker/phpunit/Dockerfile'
          }
        }
      steps {
        sh './vendor/bin/phpunit --log-junit build/reports/junit.xml --coverage-html build/coverage'
      }
    }
    stage('Behat') {
        docker {
            dockerfile {
                filename './docker/behat/Dockerfile'
            }
          }
        steps {
          sh './vendor/bin/behat -f pretty -o std -f junit -o build/reports/behat'
        }
    }
    stage('Publish Coverage') {
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
    post {
      always {
        junit 'build/reports/**/*.xml'
        archiveArtifacts artifacts: 'screenshots/*.png', fingerprint: true
      }

    }
  }