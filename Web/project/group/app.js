const express = require("express");
const fs = require("fs").promises;
const cors = require("cors");
const mariadb = require("mariadb");
const nodemailer = require("nodemailer");
require("dotenv").config();

const app = express();
const port = 3000;

const pool = mariadb.createPool({
  connectionLimit: 10,
  host: "127.0.0.1",
  user: "root",
  password: "",
  database: "mydb",
});

app.use(cors());
app.use(express.json());

// --------------------------------------------------------

const formatDate = (dateString) => {
  const date = new Date(dateString);
  const day = String(date.getDate()).padStart(2, "0");
  const month = String(date.getMonth() + 1).padStart(2, "0");
  const year = date.getFullYear();
  return `${year}-${month}-${day}`;
};

const jsonReplacer = (key, value) =>
  typeof value === "bigint" ? value.toString() : value;

// --------------------------------------------------------

app.get("/data", async (req, res) => {
  console.log("GET /data called");
  try {
    const data = await fs.readFile("./json/database.json", "utf-8");
    res.send(JSON.parse(data));
  } catch (err) {
    console.log("Error reading file:", err);
    res.status(500).send({ message: "Error fetching data" });
  }
});

app.get("/data-language", async (req, res) => {
  console.log("GET /data-language called");
  try {
    const data = await fs.readFile("./json/lang.json", "utf-8");
    res.send(JSON.parse(data));
  } catch (err) {
    console.log("Error reading file:", err);
    res.status(500).send({ message: "Error fetching data" });
  }
});

app
  .route("/kritik-dan-saran")
  .get(async (req, res) => {
    console.log("GET /kritik-dan-saran called");
    try {
      const query = "SELECT * FROM kritik_dan_saran";
      const rows = await pool.query(query);
      res.send(rows);
    } catch (err) {
      console.log("Error fetching data:", err);
      res.status(500).send({ message: "Error fetching data" });
    }
  })
  .post(async (req, res) => {
    console.log("POST /kritik-dan-saran called");
    try {
      const { user, email, rating, kritiksaran } = req.body;
      const query =
        "INSERT INTO kritik_dan_saran (user, email, rating, kritiksaran) VALUES (?, ?, ?, ?)";
      const result = await pool.query(query, [
        user,
        email,
        rating,
        kritiksaran,
      ]);
      const response = JSON.stringify(result, jsonReplacer);
      res.send(response);
    } catch (err) {
      console.log("Error inserting data:", err);
      res.status(500).send({ message: "Error inserting data" });
    }
  });

app.delete("/kritik-dan-saran/:id", async (req, res) => {
  console.log("DELETE /kritik-dan-saran called");
  const idUser = req.params.id;
  try {
    const query = `DELETE FROM kritik_dan_saran WHERE id = ${idUser}`;
    await pool.query(query);
    res.send({ message: "Data deleted successfully", id: idUser });
  } catch (error) {
    console.log("Error deleting data:", error);
    res.status(500).send({ message: "Error deleting data" });
  }
});

app
  .route("/survei-musiman")
  .get(async (req, res) => {
    console.log("GET /survei-musiman called");
    try {
      const query = "SELECT * FROM survei_musiman ORDER BY date DESC";
      const rows = await pool.query(query);
      res.send(rows.map((row) => ({ ...row, date: formatDate(row.date) })));
    } catch (err) {
      console.log("Error fetching data:", err);
      res.status(500).send({ message: "Error fetching data" });
    }
  })
  .post(async (req, res) => {
    console.log("POST /survei-musiman called");
    try {
      const { user, pilihan, komentar, date } = req.body;
      const query =
        "INSERT INTO survei_musiman (user, pilihan, komentar, date) VALUES (?, ?, ?, ?)";
      const result = await pool.query(query, [user, pilihan, komentar, date]);
      const response = JSON.stringify(result, jsonReplacer);
      res.send(response);
    } catch (err) {
      console.log("Error inserting data:", err);
      res.status(500).send({ message: "Error inserting data" });
    }
  });

app.put("/add-notif/:id", async (req, res) => {
  console.log("PUT /add-notif/:id called");
  const userId = req.params.id;
  const newNotif = req.body;
  try {
    const getQuery = "SELECT notif FROM user WHERE id = ?";
    const [user] = await pool.query(getQuery, [userId]);
    const currentNotifs = JSON.parse(user.notif || "[]");
    currentNotifs.push(newNotif);

    const updateQuery = "UPDATE user SET notif = ? WHERE id = ?";
    await pool.query(updateQuery, [JSON.stringify(currentNotifs), userId]);
    res.send({ message: "Notification added successfully." });
  } catch (err) {
    console.log("Error updating the notification:", err);
    res.status(500).send({ message: "Error updating the notification." });
  }
});

app.get("/user", async (req, res) => {
  console.log("GET /user called");
  try {
    const query = "SELECT * FROM user";
    const results = await pool.query(query);
    res.send(results);
  } catch (err) {
    console.log("Error fetching users:", err);
    res.status(500).send({ message: "Error fetching users" });
  }
});

app.get("/user/:id", async (req, res) => {
  console.log("GET /user/:id called");
  try {
    const userId = req.params.id;
    const query = "SELECT * FROM user WHERE id = ?";
    const results = await pool.query(query, [userId]);
    res.send(results);
  } catch (err) {
    console.log("Error fetching user:", err);
    res.status(500).send({ message: "Error fetching user" });
  }
});

app.post("/send-email", async (req, res) => {
  console.log("POST /send-email called");
  try {
    const { emailUser, isiBalasan } = req.body;

    const transporter = nodemailer.createTransport({
      service: "gmail",
      auth: {
        user: process.env.EMAIL_ADMIN,
        pass: process.env.EMAIL_PASS,
      },
    });

    const mailOptions = {
      from: process.env.EMAIL_ADMIN,
      to: emailUser,
      subject: "ADMIN",
      text: isiBalasan,
    };

    const info = await transporter.sendMail(mailOptions);
    res.status(200).send("Email sent: " + info.response);
  } catch (error) {
    console.log("Cannot send email:", error);
    res.status(500).send({ message: "Error sending email" });
  }
});

app
  .route("/user-vote")
  .get(async (req, res) => {
    console.log("GET /user-vote called");

    try {
      const query = `SELECT * FROM user_vote JOIN item_vote ON user_vote.film_id = item_vote.id `;
      const results = await pool.query(query);
      res.send(results);
    } catch (error) {
      console.log("Cannot get data vote:", error);
      res.status(500).send({ message: "Error fetching users" });
    }
  })
  .put(async (req, res) => {
    console.log("POST /user-vote called");
    const { film_id, nama, komentar } = req.body;

    const insertVoteQuery =
      "INSERT INTO user_vote (film_id, nama, komentar) VALUES (?, ?, ?)";
    const updateTotalVoteQuery =
      "UPDATE item_vote SET total_vote = total_vote + 1 WHERE id = ?";

    try {
      const response1 = await pool.query(insertVoteQuery, [
        film_id,
        nama,
        komentar,
      ]);

      if (response1.rowCount === 0) {
        throw new Error("Failed to insert user vote");
      }
      const response2 = await pool.query(updateTotalVoteQuery, [film_id]);
      if (response2.rowCount === 0) {
        throw new Error("Failed to update total vote");
      }

      res.status(200).send({ message: "Vote submitted successfully" });
    } catch (error) {
      console.log("Cannot update data vote:", error);
      res.status(500).send({ message: "Error processing user vote" });
    }
  })
  .delete(async (req, res) => {
    try {
      const { vote_id, film_id } = req.body;
      const deleteVoteQuery =
        "DELETE FROM user_vote WHERE vote_id = ? AND film_id = ?";
      const updateTotalVoteQuery =
        "UPDATE item_vote SET total_vote = total_vote - 1 WHERE id = ?";
      const response1 = await pool.query(deleteVoteQuery, [vote_id, film_id]);

      if (response1.rowCount === 0) {
        throw new Error("Failed to delete user vote");
      }
      const response2 = await pool.query(updateTotalVoteQuery, [film_id]);
      if (response2.rowCount === 0) {
        throw new Error("Failed to update total vote");
      }

      res.status(200).send({ message: "User vote deleted successfully" });
    } catch (error) {
      console.log("Cannot update data vote:", error);
      res.status(500).send({ message: "Error processing user vote" });
    }
  });

app
  .route("/item-vote")
  .get(async (req, res) => {
    console.log("GET /item-vote called");

    try {
      const query = `SELECT * FROM item_vote`;
      const results = await pool.query(query);
      res.send(results);
    } catch (error) {
      console.log("Cannot get data vote items:", error);
      res.status(500).send({ message: "Error fetching users" });
    }
  })
  .post(async (req, res) => {
    console.log("POST /item-vote called");
    try {
      const insertItem = `INSERT INTO item_vote(title, img_url, description, total_vote) VALUES (?, ?, ?, ?)`;
      const { title, img_url, description } = req.body;
      const response = await pool.query(insertItem, [
        title,
        img_url,
        description,
        0,
      ]);
      if (response.rowCount === 0) {
        throw new Error("Failed to get vote item");
      }
      res.status(200).send({ message: "Item vote submitted successfully" });
    } catch (error) {
      console.log("Cannot insert data vote items:", error);
      res.status(500).send({ message: "Error insert item vote" });
    }
  })
  .put(async (req, res) => {
    console.log("PUT /item-vote called");
    try {
      const data = req.body;

      const getItemVote = `SELECT * FROM item_vote WHERE id = ?`;
      const itemVote = await pool.query(getItemVote, [data.film_id]);
      if (itemVote.rowCount === 0) {
        throw new Error("Failed to get vote item");
      }
      const updateItemVote = `UPDATE item_vote SET title = ?, img_url = ?, description = ?, total_vote = ? WHERE id = ?`;
      const response = await pool.query(updateItemVote, [
        data.title,
        data.img_url,
        data.description,
        data.total_vote,
        data.id,
      ]);
      if (response.rowCount === 0) {
        throw new Error("Failed to update vote item");
      }
      res.status(200).send({ message: "Item vote submitted successfully" });
    } catch (error) {
      console.log("Cannot update data vote item:", error);
      res.status(500).send({ message: "Error processing vote item" });
    }
  })
  .delete(async (req, res) => {
    console.log("DELETE /item-vote called");

    try {
      const { id } = req.body;
      const deleteRelatdTable = "DELETE FROM user_vote WHERE film_id = ?";
      const response1 = await pool.query(deleteRelatdTable, [id]);
      if (response1.rowCount === 0) {
        throw new Error("Failed to delete related table");
      }
      const deleteVoteItem = "DELETE FROM item_vote WHERE id = ?";
      const response2 = await pool.query(deleteVoteItem, [id]);
      if (response2.rowCount === 0) {
        throw new Error("Failed to delete vote item");
      }
      res.status(200).send({ message: "Vote deleted successfully" });
    } catch (error) {
      console.log("Cannot update delete vote item:", error);
      res.status(500).send({ message: "Error processing vote item" });
    }
  });

app.use((req, res) => {
  res.status(404).send("<h1>404 not found</h1>");
});

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});
