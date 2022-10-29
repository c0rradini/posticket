<p align="center"><a><img src="public/img/icon.png" width="200"></a></p>


## Sobre Posticket

Trata-se de um trabalho de conclusão de curso da faculdade UNIPAR (Universidade Paranense) - Curso de Sistemas de Informação.

- Manual de instalação apresentado ao orientador:

## Começando
Essas instruções farão com que você obtenha uma cópia do meu projeto em operação na sua máquina local para realização de testes.


# Pré-requisitos
- Instalar o XAMPP
https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.4.30/xampp-windows-x64-7.4.30-1-VC15-installer.exe

- Instalar o Composer (e selecionar o PHP do seu XAMPP durante a instalação)
https://getcomposer.org/Composer-Setup.exe


# Instalação
- Segue o passo-a-passo para preparar com perfeição o ambiente da sua máquina para que o sistema faça uma boa execução.

    - Após a instalação dos programas, acesse a pasta do htdocs do XAMPP exclua os arquivos existentes e cole o projeto.

    - Entre no localhost/phpmyadmin e crie uma tabela com o nome ‘posticket’.

    - Copie o arquivo .env.exemple e o renomeie para .env

Após a conclusão dos passos anterior, entre no terminal e execute as seguintes linhas de comando:
```
composer install 
```
```
php artisan key:generate
```
```
php artisan migrate:fresh --seed
```
```
php artisan serve
```
Finalizado, o projeto está rodando em sua máquina na URL: localhost/8000


# Implantação
Para o primeiro login, utilize as seguintes credenciais: 
E-mail: admin@admin.com
Senha: admin
