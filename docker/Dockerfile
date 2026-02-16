FROM node:25-bullseye-slim

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

EXPOSE 3000
ENV PORT=3000
ENV HOSTNAME="0.0.0.0"

CMD ["npm", "run", "dev"]
