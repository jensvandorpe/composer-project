#!/usr/bin/env bash
set -o nounset
set -o errexit
set -o pipefail

declare no_symlinks='on'

# Linux/Mac abstraction
function get_realpath() {
    [[ ! -f "$1" ]] && return 1 # failure : file does not exist.
    [[ -n "$no_symlinks" ]] && local pwdp='pwd -P' || local pwdp='pwd' # do symlinks.
    echo "$( cd "$( echo "${1%/*}" )" 2>/dev/null; $pwdp )"/"${1##*/}" # echo result.
    return 0 # success
}

# Set magic variables for current FILE & DIR
declare -r __FILE__=$(get_realpath ${BASH_SOURCE[0]})
declare -r __DIR__=$(dirname $__FILE__)

cd $__DIR__/..
echo "Create symlinks in $__DIR__"

rm -rf  engine/Library
mkdir -p engine/Library
ln -s ../../vendor/shopware/shopware/engine/Library/CodeMirror engine/Library/CodeMirror
ln -s ../../vendor/shopware/shopware/engine/Library/ExtJs  engine/Library/ExtJs
ln -s ../../vendor/shopware/shopware/engine/Library/TinyMce engine/Library/TinyMce

rm -rf themes/Frontend/Bare
rm -rf themes/Frontend/Responsive
rm -rf themes/Backend/ExtJs
mkdir -p themes/Frontend
mkdir -p themes/Backend
ln -s ../../vendor/shopware/shopware/themes/Backend/ExtJs themes/Backend/ExtJs
ln -s ../../vendor/shopware/shopware/themes/Frontend/Bare themes/Frontend/Bare
ln -s ../../vendor/shopware/shopware/themes/Frontend/Responsive themes/Frontend/Responsive
