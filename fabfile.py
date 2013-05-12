import time, os
from fabric.api import local, env, settings
from fabric.context_managers import cd, lcd
from fabric.operations import put, run, sudo
from fabric.contrib.files import exists

env.project = 'WebPotatoRPG'
env.release = time.strftime('%Y%m%d%H%M%S')
env.shell = "/bin/bash -l -i -c"
env.git_src_path = '/home/ubuntu/laravel'
env.ssh_key_name = 'PotatoKey.pem'
env.fabfile_dir = os.path.dirname(__file__)
env.ssh_key_local_path = "%(fabfile_dir)s/%(ssh_key_name)s" % env
env.ssh_key_remote_path = "/home/ubuntu/.ssh/%(ssh_key_name)s" % env

env.hosts =['ubuntu@54.243.221.11']

def production():
    print 'env.hosts:', env.hosts
    env.scs = 'git@github.com:ChrisGermano/WebPotatoRPG.git'
    env.scs_branch = 'master'
    env.path = '/home/ubuntu/laravel'

def deploy_potato():
    production()
    stop_server()
    git_update_repo()
    start_server()

def git_update_repo():
    if not exists("%(git_src_path)s" % env):
        sudo("mkdir -p \"%(git_src_path)s\" && chown ubuntu:ubuntu %(git_src_path)s" % env)
    with cd("%(git_src_path)s" % env):
        run("git fetch")
        if exists(".git"):
            run("git checkout %(scs_branch)s && git pull origin %(scs_branch)s" % env)
        else:
            run("echo \"\nHost github.com\n\tStrictHostKeyChecking no\nIdentityFile %(ssh_key_remote_path)s\" >> /home/ubuntu/.ssh/config" % env)
            run("git clone %(scs)s ./ && git checkout %(scs_branch)s" % env)   # clone into current dir, then checkout to selected branch

def deploy():
    deploy_potato()

def restart():
    sudo("service apache2 stop")
    sudo("service apache2 start")

def stop_server():
    sudo("service apache2 stop")

def start_server():
    sudo("service apache2 start")