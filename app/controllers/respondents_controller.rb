
class RespondentsController < ApplicationController
  def index

  end

def new
    @respondent = Respondent.new
  end

  def create
    @respondent = Respondent.new(respondent_params)
    if @respondent.save
      redirect_to("/")
    else
      render :new
    end
  end

  def update
    # @point =
  end

  def show
  end

  def respondent_params
    params.require(:respondent).permit(
      :name,
      :email,
      :password,
      :password_confirmation
    )
  end

end
