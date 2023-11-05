FROM node:lts-alpine

# install dependencies
WORKDIR /ui
COPY package*.json ./
RUN npm install

# copy necessary files to container
COPY src/ src/
COPY cypress/ cypress/
COPY vite* .
COPY index.html .

# start ui
CMD [ "npm", "run", "dev" ]