# Use uma imagem base com Node.js
FROM node:14

# Diretório de trabalho dentro do contêiner
WORKDIR /usr/src/app

# Copie os arquivos de package.json e package-lock.json para o diretório de trabalho
COPY package*.json ./

# Instale as dependências
RUN npm install

# Copie todo o código da aplicação para o diretório de trabalho
COPY . .

# Exponha a porta em que a aplicação Vue.js estará em execução
EXPOSE 8080

# Comando para iniciar a aplicação
CMD ["npm", "run", "serve"]