# budget-calculator

## Project Setup

```sh
cd ./vue
npm install
npm run build

sudo ln -s ~/work/test-project/budget-calculator/nginx/local/budget-calculator.conf /etc/nginx/conf.d/
sudo systemctl reload nginx

cd ../
docker compose up -d

import dump from ./db/init_database.sql
```

### Compile and hot-reload for frontend development

```sh
cd ./vue
npm run dev
```

### Compile and Minify for Production

```sh
cd ./vue
npm run build
cp ../src/* /production
```

