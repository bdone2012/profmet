# encoding: UTF-8
# This file is auto-generated from the current state of the database. Instead
# of editing this file, please use the migrations feature of Active Record to
# incrementally modify your database, and then regenerate this schema definition.
#
# Note that this schema.rb definition is the authoritative source for your
# database schema. If you need to create the application database on another
# system, you should be using db:schema:load, not running all the migrations
# from scratch. The latter is a flawed and unsustainable approach (the more migrations
# you'll amass, the slower it'll run and the greater likelihood for issues).
#
# It's strongly recommended that you check this file into your version control system.

ActiveRecord::Schema.define(version: 20150627185511) do

  # These are extensions that must be enabled in order to support this database
  enable_extension "plpgsql"

  create_table "respondents", force: true do |t|
    t.string   "name"
    t.string   "email"
    t.string   "password_digest"
    t.string   "university"
    t.integer  "age"
    t.string   "gender"
    t.boolean  "english"
    t.string   "ethnicity"
    t.string   "major"
    t.string   "address"
    t.decimal  "balance"
    t.boolean  "paid"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "surveycodes", force: true do |t|
    t.string   "surveycode"
    t.string   "surveylink_id"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "surveylinks", force: true do |t|
    t.string   "link"
    t.integer  "time_estimate"
    t.string   "instruction"
    t.integer  "participant"
    t.integer  "started"
    t.integer  "completed"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "users", force: true do |t|
    t.string   "name"
    t.string   "email"
    t.string   "password_digest"
    t.string   "university"
    t.string   "address"
    t.decimal  "balance"
    t.decimal  "payday"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

end
