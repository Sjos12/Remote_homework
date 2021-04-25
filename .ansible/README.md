# Remote Homework Deploy

## Introduction
The [Remote Homework project]() is deployed through the following process. This repository contains various files supplying an automated deploy workflow. It build on [Ansible](https://www.ansible.com/) and uses the workflow principles of [Capistrano](https://capistranorb.com/).

Ansible is a Python-based project that executes through SSH. Ansible users will almost exclusively deal with YAML-based files that are then executed by Ansible. Since Ansible executes commands over SSH, it is not required for remote hosts to run any extra software.

The majority of scripts executed are actually provided by the [Ansistrano-project](https://ansistrano.com/). As you can guess from the name, it is inspired by Capistrano and build in Ansible.

## Prerequisites
Host:
- Python 3+ (see for [installing on OSX through PyENV](https://github.com/pyenv/pyenv#homebrew-on-macos))
- Ansible 2.9+ (see for [instructions on OSX](https://docs.ansible.com/ansible/latest/installation_guide/intro_installation.html#installing-ansible-with-pip))

## Project specifics
The deploy happens partially locally. This is done for two reasons:
- Initially the server did not support the needed NodeJS version (12+)
- The server's resources should not be bogged down by running front-end compilation

## Setup
### Install all the Ansible dependencies
```bash
ansible-galaxy install -r ./ansible/requirements.yml
```

### (optional) Setup Ansible Vault password in file
Ansible Vault is a way for encrypting secrets. The secret values will be decrypted on script runs. They could be committed to version control, but that should not be necessary and therefore be avoided. Still if only using this locally it still makes sense to encrypt secrets, better save than sorry.

For encryption one uses a password. This password can be kept in a password manager, a post-it on the side of the monitor, or in a local, uncommitted file. If you want to use this last option, to prevent having to input the vault password repeatedly, do:

Setup Ansible config to tell Ansible to use a password from file for Vault actions: 
```bash
cp ansible.cfg.example ansible.cfg
``` 

```bash
echo "your-super-secret-password" > .ansible/.vault_pass
```

### Setup secret variables with Ansible Vault
Setup the vault file from the skeleton in this repo:

```bash
cp .ansible/deploy_vault.dist.yml .ansible/vars/deploy_vault.yml && \
    ansible-vault encrypt .ansible/vars/deploy_vault.yml
```

If you setup a password file the vault will be created. If not, you will be prompted for a password first.

Now add the actual secrets to the vault:

```bash
ansible-vault edit .ansible/vars/deploy_vault.yml
```

This should be repeated for the environment specific vaults. So for example for the `test` environment:

```bash
cp .ansible/deploy_vault.ENV.dist.yml .ansible/vars/test/deploy_vault.yml && \
    ansible-vault encrypt .ansible/vars/test/deploy_vault.yml
```

And of course also set the values in these vaults. For example for the `test` environment:

```bash
ansible-vault edit .ansible/vars/test/deploy_vault.yml
```

## Deploying
To deploy just run the deploy playbook. The target environment and which branch or tag should be deployed can be added as arguments to the playbook. By default the playbook will assume that the `test` environment is target for the `develop` branch. As an example this would be done as follows:

```bash
ansible-playbook -i .ansible/hosts.yml .ansible/deploy.yml --extra-vars "target_env=test deploy_branch=develop"
```

## Rollbacks
**This feature is currently untested!**

## Anatomy of the deploy process

Let's start with the playbook command:

```bash
ansible-playbook -i hosts.yml deploy.yml --extra-vars "target_env=test deploy_branch=develop"
```

The `ansible-playbook`-part is obviously the command that is executed. Which hosts
