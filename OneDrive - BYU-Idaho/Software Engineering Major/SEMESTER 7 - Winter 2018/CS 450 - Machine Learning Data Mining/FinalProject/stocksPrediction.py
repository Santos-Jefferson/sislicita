import quandl, math, datetime
from pandas.tseries.offsets import BDay, CustomBusinessDay
from pandas.tseries.holiday import USFederalHolidayCalendar
import numpy as np
from sklearn import preprocessing, cross_validation, svm
from sklearn.linear_model import LinearRegression
import matplotlib.pyplot as plt
from matplotlib import style
style.use('ggplot')

# Using QUANDL website to get the datasets with API
quandl.ApiConfig.api_key = "pWf7mBVsoSh78qUe8yKk"
ticker = "WIKI/GOOGL"

# Defining a start and end date from QUANDL dataset
start_date = "2008-04-01"
end_date = datetime.date.today()      # This function returns the today date

# My dataset from ticker selected above
df = quandl.get(ticker, start_date=start_date, end_date=end_date)

# Defining the columns to be used
df = df[['Adj. Open','Adj. High','Adj. Low','Adj. Close','Adj. Volume']]

# dataframe original with all prices and dates
df_real = df[['Adj. Close']]

# Creating two features to add to our dataframe
# Percentage volatility of the prices and percentage change of the prices
df['pct_vol'] = (df['Adj. High'] - df['Adj. Close']) / df['Adj. Close'] * 100.0
df['pct_change'] = (df['Adj. Close'] - df['Adj. Open']) / df['Adj. Open'] * 100.0

# Creating three dataframes for the three classifiers to be used
df_lin = df[['Adj. Close','pct_vol','pct_change','Adj. Volume']]
df_svr_lin = df[['Adj. Close','pct_vol','pct_change','Adj. Volume']]
df_svr_rbf = df[['Adj. Close','pct_vol','pct_change','Adj. Volume']]

# Defining the forecast column, in this case the Adjacent Closed Price
forecast_col = 'Adj. Close'

# Filling any blank field with NA
df_lin.fillna(-99999, inplace=True)
df_svr_lin.fillna(-99999, inplace=True)
df_svr_rbf.fillna(-99999, inplace=True)

# Define the days that you want to forecast (business days and holidays)
days_forecast = 252
forecast_out = int(days_forecast)

#Shifiting the new column "label" accordingly the days forecasted above
df_lin['label'] = df_lin[forecast_col].shift(-forecast_out)
df_svr_lin['label'] = df_svr_lin[forecast_col].shift(-forecast_out)
df_svr_rbf['label'] = df_svr_rbf[forecast_col].shift(-forecast_out)

# Creating the X dataset without the label
X_lin = np.array(df_lin.drop(['label'], 1))
X_svr_lin = np.array(df_svr_lin.drop(['label'], 1))
X_svr_rbf = np.array(df_svr_rbf.drop(['label'], 1))

# Scaling the data
X_lin = preprocessing.scale(X_lin)
X_svr_lin = preprocessing.scale(X_svr_lin)
X_svr_rbf = preprocessing.scale(X_svr_rbf)
X_lin = X_lin[:-forecast_out:]
X_svr_lin = X_svr_lin[:-forecast_out:]
X_svr_rbf = X_svr_rbf[:-forecast_out:]

# Creating the X to put the predicted data
X_lately_lin = X_lin[-forecast_out:]
X_lately_svr_lin = X_svr_lin[-forecast_out:]
X_lately_svr_rbf = X_svr_rbf[-forecast_out:]

# Preparing the data to drop NAs
df_lin.dropna(inplace=True)
df_svr_lin.dropna(inplace=True)
df_svr_rbf.dropna(inplace=True)

# Creating the target dataset
y_lin = np.array(df_lin['label'])
y_svr_lin = np.array(df_svr_lin['label'])
y_svr_rbf = np.array(df_svr_rbf['label'])

# Cross validation
X_lin_train, X_lin_test, y_lin_train, y_lin_test = cross_validation.train_test_split(X_lin, y_lin, test_size=0.2)
X_svr_lin_train, X_svr_lin_test, y_svr_lin_train, y_svr_lin_test = cross_validation.train_test_split(X_svr_lin, y_svr_lin, test_size=0.2)
X_svr_rbf_train, X_svr_rbf_test, y_svr_rbf_train, y_svr_rbf_test = cross_validation.train_test_split(X_svr_rbf, y_svr_rbf, test_size=0.2)

# The classifiers
clf_svr_lin = svm.SVR(kernel='linear', C=1e3, verbose=False)
clf_svr_rbf = svm.SVR(kernel='rbf', C=1e3, gamma=0.1, verbose=False)
clf_lin = LinearRegression()

# Fitting the training data
clf_svr_lin.fit(X_svr_lin_train, y_svr_lin_train)
clf_svr_rbf.fit(X_svr_rbf_train, y_svr_rbf_train)
clf_lin.fit(X_lin_train, y_lin_train)

# Getting the accuracies
clf_svr_lin.score(X_svr_lin_test, y_svr_lin_test)
clf_svr_rbf.score(X_svr_rbf_test, y_svr_rbf_test)
clf_lin.score(X_lin_test, y_lin_test)
accuracy_svr_lin = clf_svr_lin.score(X_svr_lin_test, y_svr_lin_test)
accuracy_svr_rbf = clf_svr_rbf.score(X_svr_rbf_test, y_svr_rbf_test)
accuracy_lin = clf_lin.score(X_lin_test, y_lin_test)

# Predicting the data
forecast_predicted_svr_lin = clf_svr_lin.predict(X_lately_svr_lin)
forecast_predicted_svr_rbf = clf_svr_rbf.predict(X_lately_svr_rbf)
forecast_predicted_lin = clf_lin.predict(X_lately_lin)

# Creating the column with nan
df_lin['Forecast_lin'] = np.nan
df_svr_lin['Forecast_svr_lin'] = np.nan
df_svr_rbf['Forecast_svr_rbf'] = np.nan

# Getting the business and holiday days
bday_us = CustomBusinessDay(calendar=USFederalHolidayCalendar())

#Last date on dataset in accordingly with forecasted days inserted
last_date_lin = df_lin.iloc[-1].name
last_date_svr_lin = df_svr_lin.iloc[-1].name
last_date_svr_rbf = df_svr_rbf.iloc[-1].name
one_day = bday_us
next_bday_lin = last_date_lin + one_day
next_bday_svr_lin = last_date_svr_lin + one_day
next_bday_svr_rbf = last_date_svr_rbf + one_day

# Looping to adding every predicted price in the right date
for i in forecast_predicted_svr_lin:
    next_date_svr_lin = next_bday_svr_lin
    next_bday_svr_lin += one_day
    df_svr_lin.loc[next_date_svr_lin] = [np.nan for _ in range(len(df_svr_lin.columns)-1)] + [i]
for i in forecast_predicted_svr_rbf:
    next_date_svr_rbf = next_bday_svr_rbf
    next_bday_svr_rbf += one_day
    df_svr_rbf.loc[next_date_svr_rbf] = [np.nan for _ in range(len(df_svr_rbf.columns)-1)] + [i]
for i in forecast_predicted_lin:
    next_date_lin = next_bday_lin
    next_bday_lin += one_day
    df_lin.loc[next_date_lin] = [np.nan for _ in range(len(df_lin.columns)-1)] + [i]

# Console log to accuracies
print()
print("Accuracy SVR lin: ", forecast_out, " Days ahead: ", (accuracy_svr_lin*100).round(2), "%")
print("Accuracy SVR rbf: ", forecast_out, " Days ahead: ", (accuracy_svr_rbf*100).round(2), "%")
print("Accuracy     Lin: ", forecast_out, " Days ahead: ", (accuracy_lin*100).round(2), "%")

# Ploting the data to compare the predicted with the real data
df_real['Adj. Close'].plot(color="green", linewidth=3)
df_lin['Forecast_lin'].plot(color="red")
df_svr_lin['Forecast_svr_lin'].plot(color="blue")
df_svr_rbf['Forecast_svr_rbf'].plot(color="orange")
# plt.xlim(xmin=datetime.date(2017, 1, 1), xmax=datetime.date.today())
plt.legend(loc=4)
plt.title(ticker + " " + str(forecast_out) + " day(s) forecast\n")
plt.suptitle("Accuracy Lin:     " + str((accuracy_lin * 100).round(2)) + "%\n" +
             "Accuracy SVR Lin: " + str((accuracy_svr_lin * 100).round(2)) + "%\n" +
             "Accuracy SVR Rbf: " + str((accuracy_svr_rbf * 100).round(2)) + "%\n\n"
            )
plt.xlabel('\nDate and Time')
plt.ylabel('Price in U$')
plt.show()