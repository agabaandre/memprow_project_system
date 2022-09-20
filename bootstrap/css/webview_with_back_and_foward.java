package com.app.takenet.uhmgwops;
import android.app.Activity;
import android.content.Context;
import android.graphics.Bitmap;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Button;
import android.widget.RelativeLayout;


public class MainActivity extends AppCompatActivity {
    private Context mContext;
    private Activity mActivity;

    private RelativeLayout mRelativeLayout;
    private WebView mWebView;
    private Button mButtonBack;
    private Button mButtonForward;

    private String mUrl="http://41.186.44.174/uhmgwbos";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        // Request window feature action bar
       // requestWindowFeature(Window.FEATURE_ACTION_BAR);
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Get the application context
        mContext = getApplicationContext();
        // Get the activity
        mActivity = MainActivity.this;

        // Get the widgets reference from XML layout
        mRelativeLayout = (RelativeLayout) findViewById(R.id.rl);
        mWebView = (WebView) findViewById(R.id.web_view);
        mButtonBack = (Button) findViewById(R.id.btn_back);
        mButtonForward = (Button) findViewById(R.id.btn_forward);

        // Request to render the web page
        renderWebPage(mUrl);

        // Set a click listener for back button
        mButtonBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (mWebView.canGoBack()) {
                    mWebView.goBack();
                }
            }
        });

        // Set a click listener for forward button
        mButtonForward.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (mWebView.canGoForward()) {
                    mWebView.goForward();
                }
            }
        });
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        if (mWebView.canGoBack()){
            mWebView.canGoBack();
        }
        else{
            super.onBackPressed();
        }}

    // Custom method to render a web page
    protected void renderWebPage(String urlToRender) {
        mWebView.setWebViewClient(new WebViewClient() {
            @Override
            public void onPageStarted(WebView view, String url, Bitmap favicon) {
                // Do something on page loading started
            }

            @Override
            public void onPageFinished(WebView view, String url) {
                // Do something when page loading finished

                // Check web view back history availability
                if (mWebView.canGoBack()) {
                    mButtonBack.setEnabled(true);
                } else {
                    mButtonBack.setEnabled(false);
                }

                // Check web view forward history availability
                if (mWebView.canGoForward()) {
                    mButtonForward.setEnabled(true);
                } else {
                    mButtonForward.setEnabled(false);
                }
            }
        });

        mWebView.setWebViewClient(new WebViewClient() {
            public void onProgressChanged(WebView view, int newProgress) {
            }
        });
        mWebView.getSettings().setJavaScriptEnabled(true);

        mWebView.getSettings().setCacheMode(WebSettings.LOAD_DEFAULT);

        // Render the web page
        mWebView.loadUrl(urlToRender);

    }
}