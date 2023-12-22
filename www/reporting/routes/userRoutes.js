const express = require("express")
const router = express.Router();
const User = require("../model/User");
const bcrypt = require("bcryptjs");
const jwt = require("jsonwebtoken");
const auth = require("../middleware/auth");
const mysql = require('mysql2');
const { Sequelize } = require("sequelize");
const PORT = 7000; 
router.use(express.json());
const connection = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "123",
    database: "userauth"
});
connection.connect((err) => {
    if(err) {
        console.error('Error connecting to databsae: ', err);
    }
    console.log('Connected to mySQL Server');
});

router.post("/login", async (req, res) => {
    const { usernameOrEmail, password } = req.body;
    try {
		let user = await User.findOne({
			where: Sequelize.or(
                { email: usernameOrEmail },
                { username: usernameOrEmail }
            )
		});
		if (!user){
			return res.status(400).json({
				msg: "Invalid username/email...",
			});
		}

        const flag = await bcrypt.compare(password.trim(), user.password.trim());

        if (!flag) {
          return res.status(400).json({
              msg: "Invalid password...",
          });
        }
      
		const payload = {
			user: {
				id: user.id,
        admin: user.admin
			},
		};
    jwt.sign(payload, 'secret-key' ,{ expiresIn: 10000,}, (err, token) => {
        if (err) throw err;
        res.set('Authorization', `Bearer ${token}`);
        res.status(200).json({
          token,
          admin: user.admin,
        });
    });
    } catch (err) {
		res.status(500).json({
			msg : err.message
		});
  }
});

router.get("/secure-api/protected/", auth, async (req, res) => {
    try {
      res.sendFile('../protected/users.html');
    }
    catch (e){
      res.send({msg: "Error in fetching users.html"});
    }
});

router.post("/", async (req, res) => {
    checkpoint = 0
    const { username, email, password, admin } = req.body;
    checkpoint++;
    try {
      let user = await User.findOne({
        where: Sequelize.or(
          { email: email },
          { username: username }
      )
      });
      checkpoint++;
      if (user) {
        return res.status(400).json({
          msg: "User already exists",
        });
      }
      checkpoint++;
      const salt = await bcrypt.genSalt(10);
      const hashedPassword = await bcrypt.hash(password, salt);
  
      user = await User.create({
        username,
        email,
        password: hashedPassword,
        admin,
      });
      checkpoint++;
      console.log(user);
  
      res.status(200).json({
        msg: "User created successfully",
        user: {
          id: user.id,
          username: user.username,
          email: user.email,
          admin: user.admin,
        },
      });
    } catch (err) {
      res.status(500).json({
        msg: err.message + ` Checkpoint: ${checkpoint}` || "Server error",
        body: req.body,
      });
    }
});


router.put('/:id', async (req, res) => {
  const { username, email, password, admin } = req.body;
  try {
    let user = await User.findOne({
      where: { id: req.params.id }
    });

    if (!user) {
      return res.status(404).json({
        msg: 'User not found',
      });
    }

    const salt = await bcrypt.genSalt(10);
    const hashedPassword = await bcrypt.hash(password, salt);

    user.username = username;
    user.email = email;
    user.password = hashedPassword;
    user.admin = admin;
    
    await user.save();

    res.status(200).json({
      msg: 'User updated successfully',
      user: {
        id: user.id,
        username: user.username,
        email: user.email,
        admin: user.admin,
      },
    });
  } catch (err) {
    res.status(500).json({
      msg: err.message || 'Server error',
    });
  }
});

router.delete("/:id", async (req, res) => {
  const { username, email } = req.body;
  try {
    let user = await User.findOne({
      where: { id: req.params.id }
    });

    if (!user) {
      return res.status(404).json({
        msg: "User not found",
      });
    }

    await user.destroy();

    res.status(200).json({
      msg: "User deleted successfully",
    });
  } catch (err) {
    res.status(500).json({
      msg: err.message || "Server error",
    });
  }
});




module.exports = router;
const app = express();
app.use(router);
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});