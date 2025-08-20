FROM node:24-alpine

RUN mkdir -p /app && \
  chown -R node:node /app

WORKDIR /app

USER node

ENV npm_config_cache=/app/.npm

CMD ["/bin/sh", "-c", "npm install && npm cache clean --force && rm -rf /tmp/nitro/ && npm run dev"]