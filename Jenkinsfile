pipeline {
  node {
    label 'master'
  }

  stages {
    stage('Composer Install') {
      agent {
        dockerfile {
            filename 'Dockerfile'
            dir './docker/phpunit'
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
              dir './docker/phpunit'
          }
        }
      steps {
        sh './vendor/bin/phpunit --log-junit build/reports/junit.xml --coverage-html build/coverage'
      }
    }
    stage('Behat') {
        agent {
            dockerfile {
                filename 'Dockerfile'
                dir './docker/behat/'
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