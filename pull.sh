LOCAL_BRANCH="wahyu"

gitpull (){

	echo 'Start pull .....'
  git checkout master
  git pull origin master
  git checkout $LOCAL_BRANCH
  git fetch origin
  git merge origin/master
  echo "Pull done ....."
}

# Options
while getopts "l:bnahg:" opt; do
  case $opt in
    a)
        echo "Pull dari master branch local : $LOCAL_BRANCH"
        gitpull
      ;;
    \?)
        echo "Invalid option:" >&2
      ;;
  esac
done
# tes
