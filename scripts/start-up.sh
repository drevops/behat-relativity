#!/bin/sh
set -e

if [ -e /tmp/.installed ]; then
  echo 'Already installed.'

else
  echo ''
  echo 'INSTALLING'
  echo '----------'

  # Add Google public key to apt
  wget -q -O - "https://dl-ssl.google.com/linux/linux_signing_key.pub" | sudo apt-key add -

  # Update app-get
  sudo apt-get -y update

  sudo apt-get -y install default-jdk xvfb zip unzip gconf-service libxss1 libappindicator1 libindicator7 xdg-utils libasound2 libnspr4 libnss3 libpango1.0.0 libnss3

  cd /tmp
  wget -q https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb --progress=dot
  sudo dpkg -i google-chrome-stable_current_amd64.deb

  sudo apt-get -y install -f

  # Make Chrome run with additional flags to resolve content scaling issues.
  echo '#! /bin/bash' | sudo tee /opt/google/chrome/google-chrome-hack
  echo '/opt/google/chrome/google-chrome --high-dpi-support=1 --force-device-scale-factor=1' | sudo tee --append /opt/google/chrome/google-chrome-hack
  sudo chmod 755 /opt/google/chrome/google-chrome-hack
  sudo mv /usr/bin/google-chrome-stable /usr/bin/google-chrome-stable.backup
  cd /usr/bin && sudo ln -s /opt/google/chrome/google-chrome-hack google-chrome-stable

  # Download and copy the ChromeDriver and selenium-server-standalone to /usr/local/bin
  cd /tmp
  wget -q "https://chromedriver.storage.googleapis.com/2.25/chromedriver_linux64.zip"
  wget -q "https://selenium-release.storage.googleapis.com/2.53/selenium-server-standalone-2.53.1.jar"
  unzip chromedriver_linux64.zip
  sudo mv chromedriver /usr/local/bin -f
  sudo mv selenium-server-standalone-2.53.1.jar /usr/local/bin/selenium-server-standalone.jar -f
  sudo chmod +rx /usr/local/bin/chromedriver

  # So that running `vagrant provision` doesn't redownload everything
  touch /tmp/.installed
fi

# Start Xvfb, Chrome, and Selenium in the background
export DISPLAY=":10" &

echo "Starting Xvfb ..."
Xvfb :10 -screen 0 1366x768x24 -ac &

echo "Starting Google Chrome ..."
google-chrome --remote-debugging-port=9222 &

echo "Starting Selenium ..."
cd /usr/local/bin
java -jar selenium-server-standalone.jar -trustAllSSLCertificates -Dwebdriver.chrome.driver=chromedriver &