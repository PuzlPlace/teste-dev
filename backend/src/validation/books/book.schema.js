const Joi = require("joi");

const bookSchema = Joi.object({
        name: Joi.string().max(100).required(),
        author: Joi.string().max(100).required(),
        category: Joi.string().max(100).required(),
        uniqueCode: Joi.number().integer().min(10).message("Invalid Unique Code").max(10000).message("Invalid Unique Code").required(),
        type: Joi.string().valid("digital", "physical").required(),
        size: Joi.number().max(10000).allow("").allow(null),
        weight: Joi.number().max(10000).message("Invalid Weight").allow("").allow(null),
    })



module.exports = {
    bookSchema

}