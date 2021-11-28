/*
    Name: Shrawan Parmar
    NSID: skp196
    STD#: 11252425
    Class: CMPT 353
*/
const express = require("express");
const bodyParser = require("body-parser");
const mysql = require("mysql");

const app = express();
const PORT = 8080;
const HOST = '0.0.0.0';

app.use("/", express.static(__dirname));
app.use(bodyParser.urlencoded({ extended: true }));

// creating connection
const database = mysql.createConnection({
	host: "localhost",
	port: "3306",
	user: "root",
	database: "db",
	password: "1234", // password is 1234 in mysql. please change if needed
});

database.connect((err) => {
	if (err) {
		console.log(err);
		return;
	}
	// database.query("CREATE DATABASE IF NOT EXISTS db", function(err, result) {
	// 	if (err) throw err;
	// 	console.log("Database created!");
	// });
	// database.query("use db", function(err, result) {
	// 	if (err) throw err;
	// 	console.log("employees selected!");
	// });
	database.query("CREATE TABLE IF NOT EXISTS employeeTable (`id` INT AUTO_INCREMENT PRIMARY KEY, `name` VARCHAR(255) not null, `data` text not null, `report` text not null , `timestamp` TIMESTAMP not null default current_timestamp)", function(err, result) {
		if (err) throw err;
		console.log("Table created!");
	});

	database.query("CREATE TABLE IF NOT EXISTS dogTable (`id` INT AUTO_INCREMENT PRIMARY KEY, `name` VARCHAR(255) not null, `data` text not null, `report` text not null , `timestamp` TIMESTAMP not null default current_timestamp)", function(err, result) {
		if (err) throw err;
		console.log("Table created!");
	});

	console.log("Connection made to MySQL");
});

// app.get("/", (req, res) => {
// 	res.send("Please Navigate to /employee.html");
// });

// ********************* Insert Data *************************
app.post("/employeeInsertData", (req, res) => {
	if (req.body.name && req.body.name) {
		const name = req.body.name;
		const data = req.body.data;

		const sql = `insert into employeeTable (name, data, report) values ('${name}', '${data}', '')`;
		database.query(sql, (err, result) => {
			if (err) throw err;
			console.log("Insert sucessfully");
			res.send();
		});
	} else {
		res.status(400).send();
	}
});

app.post("/dogInsertData", (req, res) => {
	if (req.body.name && req.body.name) {
		const name = req.body.name;
		const data = req.body.data;

		const sql = `insert into dogTable (name, data, report) values ('${name}', '${data}', '')`;
		database.query(sql, (err, result) => {
			if (err) throw err;
			console.log("Insert sucessfully");
			res.send();
		});
	} else {
		res.status(400).send();
	}
});

// ************** receive data *************************
app.get("/employeeReceiveData", (req, res) => {
	const sql = "select * from employeeTable";
	database.query(sql, (err, result) => {
		if (err) throw err;
		res.send(result);
	});
});

app.get("/dogReceiveData", (req, res) => {
	const sql = "select * from dogTable";
	database.query(sql, (err, result) => {
		if (err) throw err;
		res.send(result);
	});
});

// ************************ Delete ***********************
app.post('/employeeDelete/:id', (req, res)=> {
	const id = req.params.id;

	const sql = `DELETE FROM employeeTable WHERE id = ${id}`;
	database.query(sql, (err, result) => {
		if (err) throw err;
		res.redirect("/employee.html");
		// res.send(result);
	});
});

app.post('/dogDelete/:id', (req, res)=> {
	const id = req.params.id;

	const sql = `DELETE FROM dogTable WHERE id = ${id}`;
	database.query(sql, (err, result) => {
		if (err) throw err;
		res.redirect("/dog.html");
		// res.send(result);
	});
});

// ********************* Edit ******************************
app.post('/employeeEdit/:id', (req, res)=> {
	const id = req.params.id;
	if (req.body.name && req.body.data) {
		const name = req.body.name;
		const data = req.body.data;

		const sql = `UPDATE employeeTable SET name = '${name}', data = '${data}' WHERE id = ${id}`;
		database.query(sql, (err, result) => {
			if (err) throw err;
			res.redirect("/employee.html");
			// res.send(result);
		});
	} else {
		// res.status(400).send();
		res.redirect("/employeeEdit.html?"+id);
	}
});

app.post('/dogEdit/:id', (req, res)=> {
	const id = req.params.id;
	if (req.body.name && req.body.data) {
		const name = req.body.name;
		const data = req.body.data;

		const sql = `UPDATE dogTable SET name = '${name}', data = '${data}' WHERE id = ${id}`;
		database.query(sql, (err, result) => {
			if (err) throw err;
			res.redirect("/dog.html");
			// res.send(result);
		});
	} else {
		// res.status(400).send();
		res.redirect("/dogEdit.html?"+id);
	}
});


// ********************* Report ****************************
app.post('/employeeEditReport/:id/:report', (req, res)=> {
	const id = req.params.id;
	const prevReport = req.params.report;
	if (req.body.report) {
		const report = req.body.report;

		const sql = `UPDATE employeeTable SET report = '${report}' WHERE id = ${id}`;
		database.query(sql, (err, result) => {
			if (err) throw err;
			res.redirect(`/employeeReport.html?id=${id}&report=${report}`);
			// res.send(result);
		});
	} else {
		// res.status(400).send();
		res.redirect(`/employeeReport.html?id=${id}&report=${prevReport}`);
	}
});

app.post('/dogEditReport/:id/:report', (req, res)=> {
	const id = req.params.id;
	const prevReport = req.params.report;
	if (req.body.report) {
		const report = req.body.report;

		const sql = `UPDATE dogTable SET report = '${report}' WHERE id = ${id}`;
		database.query(sql, (err, result) => {
			if (err) throw err;
			res.redirect(`/dogReport.html?id=${id}&report=${report}`);
			// res.send(result);
		});
	} else {
		// res.status(400).send();
		res.redirect(`/dogReport.html?id=${id}&report=${prevReport}`);
	}
});

app.listen(PORT, HOST);
console.log('up and running on PORT: '+PORT);
