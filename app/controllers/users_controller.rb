
class UsersController < ApplicationController
  def index

  end

def new
    @user = User.new
  end

  def create
    @user = User.new(user_params)
    if @user.save
      redirect_to("/")
    else
      render :new
    end
  end

  def update
    # @point =
  end

  def user_params
    params.require(:user).permit(
      :name,
      :email,
      :password,
      :password_confirmation
    )
  end

end
