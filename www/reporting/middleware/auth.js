const jwt = require("jsonwebtoken");

module.exports = function(req, res, next) {
	const token = req.headers['Authorization'];
	if (!token){
		return res.status(401).json({ msg: "No token in header"});
	} 	
	try {
		const decoded = jwt.verify(token, 'secret-key');
		req.user = decoded.user;
        if(!req.user.admin) {
            return res.status(403).json({msg: "Unauthorized acces"});
        }
		next();
	} catch (err) {
		res.status(500).json({
			msg : err.message
		});
	}
};