# Statistical Lab (SLab)

![Sistema de perguntas e respostas](screenshots/quiz.png)

![Painel administrativo](screenshots/admin.png)

## Como rodar o ambiente para desenvolvimento?

Entre dentro da pasta `bin` e emita o comando:

```console
sudo ./configurar_ambiente_dev.sh
```

Em seguida execute o comando:

```console
sudo ./slab.sh dev
```

Pronto! Agora você já pode fazer edições nos códigos do SLab.

## Como iniciar o ambiente em produção?

Entre dentro da pasta `bin` e emita o comando:

```console
sudo ./slab.sh prod
```

Pronto! O sistema subirá os containers que são necessários para a execução.