class CreateUsers < ActiveRecord::Migration
  def change
    create_table :users do |t|
      t.string :name
      t.string :email
      t.string :password_digest
      t.string :university
      t.string :address
      t.decimal :balance
      t.decimal :payday

      t.timestamps
    end
  end
end
