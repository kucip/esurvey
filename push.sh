LOCAL_BRANCH="wahyu"
REMOTE_REPO="bixboxgames"

gitpush (){
    git add --all
    git commit -m "$*"
    git push origin $LOCAL_BRANCH
    pull_request
    echo "Push Done ..."
}

pull_request() {
  to_branch=$1
  if [ -z $to_branch ]; then
    to_branch="master"
  fi
  
  # try the upstream branch if possible, otherwise origin will do
  upstream=$(git config --get remote.upstream.url)
  origin=$(git config --get remote.origin.url)
  if [ -z $upstream ]; then
    upstream=$origin
  fi
  
  to_user=$(echo $upstream | sed -e 's/.*[\/:]\([^/]*\)\/[^/]*$/\1/')
  from_user=$(echo $origin | sed -e 's/.*[\/:]\([^/]*\)\/[^/]*$/\1/')
  from_branch=$(git rev-parse --abbrev-ref HEAD)
  open "https://github.com/$to_user/$REMOTE_REPO/compare/$to_branch...$from_branch"
}

# Options
while getopts "l:bnahg:" opt; do
  case $opt in
    a)
        echo "Push Ke Branch Local"
        gitpush $2
      ;;
    \?)
        echo "Invalid option: -$2" >&2
      ;;
  esac
done

#test