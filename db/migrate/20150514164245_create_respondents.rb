class CreateRespondents < ActiveRecord::Migration
  def change
    create_table :respondents do |t|
      t.string :name
      t.string :email
      t.string :password_digest
      t.string :university
      t.integer :age
      t.string :gender
      t.boolean :english
      t.string :ethnicity
      t.string :major
      t.string :address
      t.decimal :balance
      t.boolean :paid

      t.timestamps
    end
  end
end
