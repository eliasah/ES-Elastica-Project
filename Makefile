compile:
	composer install --no-dev
update:
	composer update
autoload:
	composer dump-autoload
clean:
	@rm -Rf *~ *#
mrproper: clean
	@rm -Rf vendor *.lock
