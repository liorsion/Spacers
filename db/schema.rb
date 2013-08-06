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

ActiveRecord::Schema.define(version: 20130806085209) do

  # These are extensions that must be enabled in order to support this database
  enable_extension "plpgsql"

  create_table "messages", force: true do |t|
    t.integer  "sender_id"
    t.integer  "receiver_id"
    t.string   "message"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.integer  "speed"
    t.integer  "knowledge"
    t.integer  "race_id"
    t.integer  "status",      default: 0
  end

  create_table "participations", force: true do |t|
    t.integer  "race_id"
    t.integer  "runner_id"
    t.boolean  "racer"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.integer  "speed"
    t.integer  "knowledge"
  end

  create_table "races", force: true do |t|
    t.string   "name"
    t.datetime "startTime"
    t.float    "lat"
    t.float    "lng"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "url"
    t.string   "terms_url"
    t.string   "image_url"
  end

  create_table "runners", force: true do |t|
    t.string   "firstName"
    t.string   "lastName"
    t.string   "email"
    t.boolean  "deleteRecord"
    t.string   "sex"
    t.string   "home"
    t.string   "status"
    t.string   "experience"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "encrypted_password",     default: "", null: false
    t.string   "reset_password_token"
    t.datetime "reset_password_sent_at"
    t.datetime "remember_created_at"
    t.integer  "sign_in_count",          default: 0
    t.datetime "current_sign_in_at"
    t.datetime "last_sign_in_at"
    t.string   "current_sign_in_ip"
    t.string   "last_sign_in_ip"
    t.string   "confirmation_token"
    t.datetime "confirmed_at"
    t.datetime "confirmation_sent_at"
    t.string   "unconfirmed_email"
    t.integer  "failed_attempts",        default: 0
    t.string   "unlock_token"
    t.datetime "locked_at"
  end

  add_index "runners", ["confirmation_token"], name: "index_runners_on_confirmation_token", unique: true, using: :btree
  add_index "runners", ["email"], name: "index_runners_on_email", unique: true, using: :btree
  add_index "runners", ["reset_password_token"], name: "index_runners_on_reset_password_token", unique: true, using: :btree
  add_index "runners", ["unlock_token"], name: "index_runners_on_unlock_token", unique: true, using: :btree

end
