const { Sequelize, DataTypes } = require('sequelize');
const sequelize = new Sequelize('userauth', 'root', '123', {
    host: 'localhost',
    dialect: 'mysql',
});

const User = sequelize.define('User', {
    id: {
        type: DataTypes.INTEGER,
        primaryKey: true,
        autoIncrement: true,
        field: 'id',
    },
    username: {
        type: DataTypes.STRING,
        allowNull: false,
        field: 'username',
        unqiue: true,
    },
    email: {
        type: DataTypes.STRING,
        alowNull: false,
        unique: true,
        field: 'email',
        unqiue: true,
    },
    password: {
        type: DataTypes.STRING,
        allowNull: false,
        field: 'password',
    },
    admin: {
        type: DataTypes.BOOLEAN,
        defaultValue: false,
        field: 'admin',
    },
}, {
    tableName: 'users',
});

module.exports = User;