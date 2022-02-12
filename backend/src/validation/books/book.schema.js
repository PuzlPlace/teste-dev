const Joi = require("joi");

const bookSchema = Joi.object({
        name: Joi.string().max(100).required(),
        author: Joi.string().max(100).required(),
        category: Joi.string().max(100).required(),
        uniqueCode: Joi.number().integer().min(10).message("Invalid Unique Code").max(10000).message("Invalid Unique Code").required(),
        type: Joi.string().valid("digital", "physical").required(),
        size: Joi.string().max(100).required(),
        weight: Joi.number().integer().min(10).message("Invalid Weight").max(10000).message("Invalid Weight").required(),
    })



module.exports = {
    bookSchema

}