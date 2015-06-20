class SessionrController < ApplicationController

  def new
  end

  def create
    # find the respondent by the given email
    respondent = Respondent.find_by(email: params[:email])
    # if we found the user and they gave us the right password
    if respondent && respondent.authenticate(params[:password])
      # store respondent id in session
      # i made up the key. i could call it football
      session[:respondent_id] = respondent.id
     redirect_to respondent_path(session[:respondent_id])
    else
      # rerender the login form
      render(:new)
    end
  end

  def destroy
    # we can set the session respondent_id to nil
    session[:respondent_id] = nil
    redirect_to(root_path)
  end
end
