import java.io.*;
import java.net.*;

public class QPClient {
    public static void main(String[] args) {
        try {
            URL url = new URL("http://blitz.cs.niu.edu/PurchaseOrder/");
            HttpURLConnection con = (HttpURLConnection)url.openConnection();
            con.setRequestMethod("POST");
            con.setDoOutput(true);

            //Construct request parameters 
            String data = "order=" + URLEncoder.encode("8765431", "UTF-8") 
                    + "&name=" + URLEncoder.encode("IBM Corporation", "UTF-8") 
                    + "&amount=" + URLEncoder.encode("7654.32", "UTF-8");

            System.out.println("Sending: " + data);
            DataOutputStream out = new DataOutputStream(con.getOutputStream());
            out.writeBytes(data);

            // Get the response
            BufferedReader in = new BufferedReader(new InputStreamReader(con.getInputStream()));
            String line;
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
