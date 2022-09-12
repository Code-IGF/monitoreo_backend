

# See here for image contents: https://github.com/microsoft/vscode-dev-containers/tree/v0.231.6/containers/php/.devcontainer/base.Dockerfile

# [Choice] PHP version (use -bullseye variants on local arm64/Apple Silicon): 8, 8.1, 8.0, 7, 7.4, 7.3, 8-bullseye, 8.1-bullseye, 8.0-bullseye, 7-bullseye, 7.4-bullseye, 7.3-bullseye, 8-buster, 8.1-buster, 8.0-buster, 7-buster, 7.4-buster
ARG VARIANT="8.1"
FROM mcr.microsoft.com/vscode/devcontainers/php:0-${VARIANT}

# [Choice] Node.js version: none, lts/*, 16, 14, 12, 10
ARG NODE_VERSION="none"
RUN if [ "${NODE_VERSION}" != "none" ]; then su vscode -c "umask 0002 && . /usr/local/share/nvm/nvm.sh && nvm install ${NODE_VERSION} 2>&1"; fi

# Install PostgreSQL driver
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pgsql pdo_pgsql

#
WORKDIR /app
ADD . .


