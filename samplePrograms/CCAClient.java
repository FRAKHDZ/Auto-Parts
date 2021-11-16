import java.io.*;
import java.net.*;

public class CCAClient {
    public static void main(String[] args) {
        try {
            URL url = new URL("http://blitz.cs.niu.edu/CreditCard/");
            HttpURLConnection con = (HttpURLConnection)url.openConnection();
            con.setRequestMethod("POST");
            con.setDoOutput(true);

            //Construct request parameters    
            String data = "cc=" + URLEncoder.encode("6011 1234 4321 1234", "UTF-8") 
                    + "&name=" + URLEncoder.encode("John Doe", "UTF-8") 
                    + "&exp=" + URLEncoder.encode("12/2016", "UTF-8") 
                    + "&amount=" + URLEncoder.encode("654.32", "UTF-8");

            System.out.println("Sending: " + data);
            DataOutputStream out = new DataOutputStream(con.getOutputStream());
            out.writeBytes(data);

            // Get the response
            BufferedReader in = new BufferedReader(new InputStreamReader(con.getInputStream()));
            String line;
            //streamReader = holding the data... can put it through a DOM loader?
            while ((line = in.readLine()) != null) {
                System.out.println(line);
            }
        } catch (MalformedURLException | UnsupportedEncodingException me) {
            System.out.println("MalformedURLException: " + me);
        } catch (IOException ioe) {
            System.out.println("IOException: " + ioe);
        }
    }
}
