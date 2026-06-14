# Build
FROM node:26.3-alpine AS builder
WORKDIR /app
RUN apk update && apk upgrade --no-cache
COPY package*.json tsconfig.json ./
RUN npm install
COPY src ./src
RUN npm run build

# Production
FROM node:26.3-alpine
WORKDIR /app
RUN apk update && apk upgrade --no-cache
COPY package*.json ./
RUN npm install --production
COPY --from=builder /app/dist ./dist
EXPOSE 8000
CMD ["npm", "start"]