class User < ActiveRecord::Base
  has_secure_password
  has_many :respondents

  # validates(:email,    { :uniqueness   => { case_sensitive: false }})
end
