backup:
	sudo docker exec budget-calculator-mysql-1 mysqldump -u root -proot budget_calculator > $(date +\%Y\%m\%d_\%H\%M\%S)_dump.sql