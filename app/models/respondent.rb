class Respondent < ActiveRecord::Base
   has_secure_password
   has_many :users

  # validates(:email,    { :uniqueness   => { case_sensitive: false }})
end
