compile:
	php ./composer.phar install --no-dev
update:
	php ./composer update
autoload:
	php ./composer dump-autoload
clean:
	@rm -Rf *~ *#
mrproper: clean
	@rm -Rf vendor *.lock
