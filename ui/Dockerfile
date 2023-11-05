FROM node:lts-alpine

# install dependencies
WORKDIR /ui
COPY package*.json ./
RUN npm install
COPY src/ src/
COPY cypress/ cypress/
COPY vite* .
COPY index.html .

# start HTTP server at root
CMD [ "npm", "run", "dev" ]