# Planning do projeto Eduhub

## 1 - O que é ?

O projeto **Eduhub** consiste em um sistema onde Clientes (donos de redes de escolas) conseguem gerar PEIs para os alunos baseado em suas questões comportamentais (neurodivergências). A parte da geração do PEI em si já está sendo feita em um N8N separado utilizando IA. A ideia do projeto é fornecer uma interface para o cadastro dos alunos, os planos de aula e geração do PEI por meio de uma interface gráfica que fará a chamada ao N8N.

## 2 - Qual a stack ?

Será utilizando Laravel 12 com Filament 4. Para o banco será utilizado Mysql. Para o cache, caso necessário, será utilizado Redis. Para salvamento de arquivos, caso necessário, será utilizado o Minio.

## 3 - Entidades principais do sistema

1. **User:** Tabela principal pros usuários do sistema. É necessária uma entrada nessa tabela para se logar aos painéis do sistema. Usuários admin são os únicos que podem acessar o painel admin.
2. **Client:** Aqui é o cliente principal, ou seja, o dono da rede de escolas. É o usuário que terá mais acessos ao painel de clientes.
3. **Coordinator:** Segundo maior nível no painel de clientes, terá acesso a diversas funcionalidades, contudo apenas referentes a escola ao qual ele está ligado
4. **Professor:** Último nível de acesso. Terá alguns acessos relacionados as escolas ao qual ele está ligado.
5. **Grade:** É a śerie (1ª, 2ª, 3ª, etc). Será pré cadastrada no sistema e poderá ser usada por todos os clientes em suas escolas.
6: **School:** É a escola em si. Um cliente pode cadastrar diversas escolas.
7: **Subject:** É a matéria. Será cadastrada pelo cliente e pode ser usada em qualquer uma das escolas ao qual ele é dono.
8. **Student:** É o aluno, sendo o mesmo ligado a uma escola específica. Além disso, um aluno deve poder ser ligado a uma determinada grade.


## 4 - Alguns casos de uso

1. O usuário admin deve poder cadastrar clientes, os quais terão como senha padrão o seu documento sem pontuações.
2. O Cliente deve poder cadastrar escolas, professores, coordenados (lembrando que professores e coordenadores devem ter uma ligação com um user próprio deles, colocando a role correspondente no user).
3. Para as grades, deve ser possível informar as subjects que fazem parte dela (por escola)
4. Um aluno, estando ligado a uma school e a uma grade, deve poder ser ligado a uma turma daquela school e grade.
5. Deve-se ter uma página com a listagem de turmas de uma determinada série (com filtro por ano)
    1. Nessa página, para cada turma, deve-se ter um botão para o professor subir o plano de aula para um determinado bimestre daquela turma
6. Deve-se ter uma página de students de uma determinada turma
    1. Para cada aluno, deve-se ter um botão de geração de PEI. No modal que acontece a geração, deve-se ter um campo para selecionar o bimestre e um campo de Observações com o placeholder: "Coloque aqui o que for especifico do aluno". Essa opção de geração de PEI só deve ser possível caso o professor já tenha subido o plano de aula daquela turma, para aquele bimestre. O PEI gerado deve ser salvo, com o identificador do aluno, da turma, de quem clicou para fazer a geração e o link do arquivo PEI retornado pela IA.
    2. Para cada aluno, deve-se ter um botão para gerar o caderno de atividades baseado em um PEI específico, dentre os que foram gerados, sendo que o último PEI gerado deve ser considerado como padrão.

## 5 - Dados de estudantes
### O cadastro de alunos deve ter alguns dados relacionados a sua avaliação psicológica, motora e social. Esses dados vão ser mais específicados a seguir.
1. Nome completo
2. Diagnóstico (Ex: Autismo)
3. CID(s) (CIDs relacionados a avaliação médica do estudante)
4. Data de nascimento
5. Ano Escolar
6. Turno (Manhã e Tarde)
7. Nível de Suporte (Baixo, Moderado, Alto)
8. Estágio de Alfabetização (pré-sibálico, silábico, silábico-alfabético, alfabético)
9. Socialização (Normal, Poucos Conflitos, Muitos Conflitos, Agressividade)
10. Comunicação Verbal (verbal, Usa palavras coerentes, Tem fala desconexa, Averbal)
11. Autonomia (faz sozinho, faz se for direcionado, só faz com apoio, não faz)
12. Tempo de concentração (em minutos)
13. Perfil de aprendizagem (Visual, Auditivo, Cinestésico, Lógico-Matemático)
14. Outas informações relevantes.