:copy commit
commit:
	SVN_SSH="ssh -i /Users/adam/.ssh/id_rsa_np" SVN_EDITOR='mate -w' svn commit
copy-apple:
	/usr/bin/rsync -Cav --delete --stats --progress --exclude="rrds" --exclude="cache" --exclude="lib/config.local.php" --rsh="ssh -i /Users/adam/.ssh/id_rsa_np" --exclude=".svn" /Users/adam/Scripts/sites/d.adam.gs/ adam@apple.adam.gs:/www/d.adam.gs/
copy:	copy-apple