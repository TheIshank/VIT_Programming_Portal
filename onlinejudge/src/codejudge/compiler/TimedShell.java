/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Licensed under MIT License.
 *
 * Codejudge Timer Shell that executes a commend with a timeout period
 */

package codejudge.compiler;

import codejudge.compiler.languages.Language;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.util.logging.Level;
import java.util.logging.Logger;

public class TimedShell extends Thread {
	
	Language parent;
	Process p;
	long time;
        
        private static final String TASKLIST = "tasklist";
        private static final String KILL = "taskkill /F /IM ";
        // Two strings initialized, for killing a given process

	
	public TimedShell(Language parent, Process p, long time){
		this.parent = parent;
		this.p = p;
		this.time = time;
             
	}
        
        // Function to kill a specific process, which takes the name of the process as the parameter
        public static void killProcess(String serviceName) throws Exception {
            Runtime.getRuntime().exec(KILL + serviceName);
        }
	
	// Sleep until timeout and then terminate the process
	public void run() {
            /* 
            
             How does this work? The time parameter represents the upper bound on the execution time. Thus, the current thread is made to sleep 
             for the specified amount of time. Execution is suspended till that time. Now, the object p of process class contains the return value
             of the "r.exec()" function ( Refer to C.java class). Thus, if the thread completes its delay (sleep), it will move onto the
             try block which contains the "exitValue()" function. This function returns 0 if the process has finished execution, and returns an exception 
             IllegalThreadStateException otherwise. The exception is caught, and the corresponding process is killed (here -"a.exe").
            
            */
            
            
            
		try {
                      System.out.println("\nBefore Sleep - ");
                      
                      // Sleep till the given timeout period
		       sleep(time);
                       
                       
                      System.out.println("\nAfter Sleep - ");
                       
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
		try {
			System.out.println("Exit value - "+ p.exitValue()); // Return 0, otherwise exception is caught below
                        
			parent.timedout = false;// No exception - No timeout
                        System.out.println("Did not timeout - \n");
		} catch (IllegalThreadStateException e) {
                    
                    
			parent.timedout = true; // Enters exception block. Thus, timeout is TRUE
                       System.out.println("Timeeout!\n");
                        
			//p.destroy();
                    try {
                     // killProcess("Java(TM) Platform SE binary"); 
                        
                        killProcess("a.exe"); // Kill the process "a.exe" which might be in an infinite loop, and so will not be terminated unless it is forecefully killed
                        killProcess("python.exe"); // Might be an irrelevant statement
                       // System.out.println("Killed\n");
                        
                    } catch (Exception ex) {
                       // System.out.println("Not Killed\n");
                        Logger.getLogger(TimedShell.class.getName()).log(Level.SEVERE, null, ex);
                    }
		}
	}
}