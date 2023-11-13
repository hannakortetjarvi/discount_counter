FROM node:lts

# install dependencies
WORKDIR /ui
COPY package*.json ./
RUN npm install

# copy necessary files to container
COPY src/ src/
COPY data/ data/
COPY cypress/ cypress/
COPY vite* ./
COPY index.html ./
RUN npm run build

# start ui
EXPOSE 3000
CMD [ "npm", "run", "dev" ]